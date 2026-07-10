from ortools.sat.python import cp_model

class SchedulerSolution:
    def __init__(self, data):
        self.data = data
        self.gurus = {g['id']: g for g in data['gurus']}
        self.mapels = {m['id']: m for m in data['mapels']}
        self.kelas_list = {k['id']: k for k in data['kelas']}
        self.ruangans = {r['id']: r for r in data['ruangans']}
        self.semua_hari = data['hari']
        self.semua_jam = data['jam']
        self.bebans = data['bebans']

        self.hari_ids = [h['id'] for h in self.semua_hari]
        self.jam_ids_normal = [j['id'] for j in self.semua_jam if 'istirahat' not in j.get('nama', '').lower()]
        self.ruangan_ids = list(self.ruangans.keys())
        self.kelas_ids = list(self.kelas_list.keys())
        self.guru_ids = list(self.gurus.keys())

    def solve(self):
        model = cp_model.CpModel()
        assignments = {}
        slot_guru = {}
        slot_kelas = {}
        slot_ruangan = {}

        for b in self.bebans:
            gid = b['guru_id']
            mid = b['mapel_id']
            kid = b['kelas_id']
            jp = b['jumlah_jam']
            is_praktikum = self.mapels[mid]['jenis'] == 'praktikum'

            for hid in self.hari_ids:
                for jid in self.jam_ids_normal:
                    for rid in self.ruangan_ids:
                        var = model.NewBoolVar(f'a{gid}_{mid}_{kid}_{hid}_{jid}_{rid}')
                        assignments[(gid, mid, kid, hid, jid, rid)] = var

                        key_guru = (gid, hid, jid)
                        if key_guru not in slot_guru:
                            slot_guru[key_guru] = []
                        slot_guru[key_guru].append(var)

                        key_kelas = (kid, hid, jid)
                        if key_kelas not in slot_kelas:
                            slot_kelas[key_kelas] = []
                        slot_kelas[key_kelas].append(var)

                        key_ruang = (rid, hid, jid)
                        if key_ruang not in slot_ruangan:
                            slot_ruangan[key_ruang] = []
                        slot_ruangan[key_ruang].append(var)

        for b in self.bebans:
            gid = b['guru_id']
            mid = b['mapel_id']
            kid = b['kelas_id']
            jp = b['jumlah_jam']
            vars_for_beban = [v for (g, m, k, h, j, r), v in assignments.items()
                            if g == gid and m == mid and k == kid]
            if vars_for_beban:
                model.Add(sum(vars_for_beban) == jp)

        for key, vars_list in slot_guru.items():
            model.Add(sum(vars_list) <= 1)

        for key, vars_list in slot_kelas.items():
            model.Add(sum(vars_list) <= 1)

        for key, vars_list in slot_ruangan.items():
            model.Add(sum(vars_list) <= 1)

        for b in self.bebans:
            mid = b['mapel_id']
            if self.mapels[mid]['jenis'] != 'praktikum':
                continue
            gid = b['guru_id']
            kid = b['kelas_id']
            for hid in self.hari_ids:
                for jidx in range(len(self.jam_ids_normal) - 1):
                    jid1 = self.jam_ids_normal[jidx]
                    jid2 = self.jam_ids_normal[jidx + 1]
                    vars1 = [v for (g, m, k, h, j, r), v in assignments.items()
                            if g == gid and m == mid and k == kid and h == hid and j == jid1]
                    vars2 = [v for (g, m, k, h, j, r), v in assignments.items()
                            if g == gid and m == mid and k == kid and h == hid and j == jid2]
                    if vars1 and vars2:
                        sum1 = sum(vars1)
                        sum2 = sum(vars2)
                        model.Add(sum1 == sum2)

        solver = cp_model.CpSolver()
        solver.parameters.num_search_workers = 8
        solver.parameters.max_time_in_seconds = 120
        status = solver.Solve(model)

        if status == cp_model.OPTIMAL or status == cp_model.FEASIBLE:
            result = []
            for (gid, mid, kid, hid, jid, rid), var in assignments.items():
                if solver.Value(var) == 1:
                    result.append({
                        'guru_id': gid,
                        'mata_pelajaran_id': mid,
                        'kelas_id': kid,
                        'hari_id': hid,
                        'jam_id': jid,
                        'ruangan_id': rid,
                    })
            return {'status': 'success', 'jadwal': result,
                    'optimal': status == cp_model.OPTIMAL}
        else:
            return {'status': 'failed', 'message': 'Tidak ada solusi yang ditemukan'}
