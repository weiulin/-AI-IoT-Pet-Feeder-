from flask import Flask, render_template, request, jsonify
import subprocess
import requests

app = Flask(__name__, template_folder='C:/xampp/htdocs/PHP/templates')

# Line Notify settings
LINE_NOTIFY_TOKEN = 'RZSqe1XtmeOf554aAVzvSc8x6HrWu4hYR77QAXidd1v'
LINE_NOTIFY_API = 'https://notify-api.line.me/api/notify'
LINE_NOTIFY_HEADERS = {
    "Authorization": f"Bearer {LINE_NOTIFY_TOKEN}",
    "Content-Type": "application/x-www-form-urlencoded"
}

process = None

def send_line_notify(message):
    payload = {'message': message}
    response = requests.post(LINE_NOTIFY_API, headers=LINE_NOTIFY_HEADERS, data=payload)
    if response.status_code == 200:
        print("Notification sent successfully")
    else:
        print(f"Failed to send notification: {response.status_code}")

@app.route('/')
def index():
    return render_template('Notify.html')

@app.route('/toggle_notify', methods=['POST'])
def toggle_notify():
    global process
    action = request.form.get('action')
    if action == 'ON':
        if process is None:
            startupinfo = subprocess.STARTUPINFO()
            startupinfo.dwFlags |= subprocess.STARTF_USESHOWWINDOW
            startupinfo.wShowWindow = subprocess.SW_HIDE
            process = subprocess.Popen(["C:/Users/User/Desktop/NDHU_CSIE/catDetect/cat_monitor/run_monitor.bat"], startupinfo=startupinfo)#Batch file Path
            send_line_notify("餵食通知已啟用")
            return jsonify(status="餵食通知啟用")
    elif action == 'OFF':
        if process is not None:
            subprocess.call(["taskkill", "/F", "/T", "/PID", str(process.pid)])
            process = None
            send_line_notify("餵食通知已關閉")
            return jsonify(status="餵食通知關閉")
    else:
        return jsonify(status="無效操作")

if __name__ == "__main__":
    app.run(debug=True)
