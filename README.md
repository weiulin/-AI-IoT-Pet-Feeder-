# -AI-IoT-Pet-Feeder-
📌 專案簡介 本專案為一套結合 AI 辨識與感測器的智慧寵物餵食器系統，使用少量影像樣本進行個體辨識（Few-Shot Learning），並整合溫濕度、體重、攝影模組等感測裝置，實現自動餵食與健康監控功能。使用者可透過網頁平台即時查看餵食紀錄與寵物狀態。

🛠 使用技術
Python/Pytorch (影像辨識模型)

ESP32-CAM 模組（攝影）

Arduino + 感測器（HX711 重量模組、DHT11 濕度）

Few-Shot Learning（Siamese Network + Contrastive Loss）

ResNet-18 (Backbone)

Flask + 網頁前端（基本）

MQTT / 串列通訊整合

MySQL

🎯 專案特色
✅ 自動餵食控制（可遠端調整餵食量）

✅ 體重、濕度感測器資料即時上傳與顯示

✅ 使用少量圖片即可辨識不同貓咪

✅ 支援辨識不同角度的同一隻貓

✅ 模型訓練採用 Siamese Network 架構，對比損失優化效果

✅ 可擴充至辨識體態或異常提醒

📷 系統架構圖
[ ESP32-CAM ] → 拍攝影像 → 傳至伺服器
[ 重量感測器 / 濕度感測器 ] → 數據上傳 → 整合至後端資料庫
[ AI 模型（ResNet + Siamese）] → 貓咪個體辨識
[ 使用者網頁介面 ] → 顯示寵物狀態、餵食控制

🚀 執行方式（簡略說明）
訓練模型：請見 train_model.py

ESP32-CAM 硬體程式與感測器代碼於 hardware/ 資料夾中

主伺服器端後端為 app.py，可啟動 Web UI 與資料接收端

📁 資料夾結構（可依實作補充）
pet_feeder_project/
├── model/                 # 訓練模型檔案
├── hardware/              # ESP32 與 Arduino 感測器代碼
├── app.py                 # 主伺服器與控制介面
├── templates/             # 前端網頁模板
├── static/                # 靜態圖片與樣式
├── README.md

📈 模型訓練說明（精簡）
使用 ResNet-18 為特徵擷取 backbone

Siamese Network 結構輸入兩張圖片，比對相似度

損失函數為 Contrastive Loss，強化同一貓 / 不同貓之區別距離

訓練資料來源為模擬用戶僅提供 3–5 張照片的情境，強調泛化能力
