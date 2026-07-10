from flask import Flask, request, jsonify
from scheduler import SchedulerSolution
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

@app.route('/api/generate', methods=['POST'])
def generate():
    try:
        data = request.get_json()
        scheduler = SchedulerSolution(data)
        result = scheduler.solve()
        return jsonify(result)
    except Exception as e:
        import traceback
        return jsonify({'status': 'error', 'message': str(e), 'trace': traceback.format_exc()}), 500

@app.route('/health', methods=['GET'])
def health():
    return jsonify({'status': 'ok'})

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=False)
