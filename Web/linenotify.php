<?php
$db_host = 'localhost';
$db_user = 'root';
$db_password = '411021233';
$db_name = 'testdata';

// Line Notify token
$line_notify_token = 'RZSqe1XtmeOf554aAVzvSc8x6HrWu4hYR77QAXidd1v';

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}

echo "連接成功\n";

$sql = "SELECT name, weight, years, months FROM cats";
$result = $conn->query($sql);

if ($result === false) {
    die("查詢失敗: " . $conn->error);
}

echo "查詢成功\n";

if ($result->num_rows > 0) {
    foreach ($result as $row) {
        $cat_name = $row["name"];
        $weight = $row["weight"];
        $years = $row["years"];
        $months = $row["months"];

        $age_years = floor($years + $months / 12);
        $age_months = $months % 12;

        if ($age_years < 1) {
            if ($months <= 3) {
                $min_weight = 0.4;
                $max_weight = 0.8;
            } elseif ($months <= 6) {
                $min_weight = 1.3;
                $max_weight = 1.8;
            } elseif ($months <= 9) {
                $min_weight = 1.9;
                $max_weight = 1.9;
            } else {
                $min_weight = 2;
                $max_weight = 3.2;
            }
        } else {
            $min_weight = 2.8;
            $max_weight = 5.3;
        }

        if (!($min_weight <= $weight && $weight <= $max_weight)) {
            $message = "\n貓咪：" . $cat_name . "\n年齡：" . $years . "歲" . $months . "個月\n體重：" . $weight . " 公斤\n\n";

            if ($weight < $min_weight) {
                $message .= "體重低於該年齡層的平均體重！\n\n";
                $message .= "飼養建議：\n\n";
                $message .= "1. 不要只給予單一食材做為主食。溼糧罐頭的部分建議需要區分為主食罐與副食罐，並注意熱量、蛋白質、牛磺酸、微量礦物質與維生素的攝取量，維持營養均衡。\n\n";
                $message .= "2. 環境造成的緊迫將會從心理影響到生理，也可能造成體重突然下降。建議多陪伴貓咪來緩解緊張的心情。\n\n";
                $message .= "3. 如果貓咪吃太多零食，會導致挑食，建議讓貓咪在吃完主餐後再吃零食。\n\n";
                $message .= "4. 貓突然變瘦可能是以下疾病引起的：\n\n";
                $message .= "  - 甲狀腺功能亢進\n";
                $message .= "  - 糖尿病\n";
                $message .= "  - 腸道細菌發炎\n";
                $message .= "  - 炎症性腸病 (IBD)\n";
                $message .= "  - 腸道寄生蟲\n";
                $message .= "  - 牙齒、口腔問題\n";
                $message .= "發現貓咪變瘦太多且太快時，請盡快尋求專業獸醫師幫助。";
            }

            if ($weight > $max_weight) {
                $message .= "體重高於該年齡層的平均體重！\n\n";
                $message .= "飼養建議：\n\n";
                $message .= "1. 肥胖可能引發一系列健康問題，包括糖尿病、關節問題、心臟病等疾病。\n\n";
                $message .= "2. 合理的減肥目標：根據貓咪的年齡、品種和健康狀況，確立一個合理的減肥目標。過快的減肥可能對貓咪的健康造成負面影響。\n\n";
                $message .= "3. 飲食控制：精確控制每日的飲食量，可以選擇低熱量、高纖維的貓糧，並善用網頁控制餵食量、監控飼料消耗量並分次餵食，避免自由餵食。\n\n";
                $message .= "4. 增加活動量：鼓勵貓咪進行更多的運動，可以使用玩具、進行互動性遊戲，提高貓咪的活動量。\n\n";
                $message .= "5. 高蛋白質飲食：增加蛋白質攝入，有助於維持肌肉質量，同時提供飽足感。\n\n";
                $message .= "6. 定期體重監控：定期使用網頁並更新貓咪的體重。\n\n";
                $message .= "7. 請教獸醫：在制訂減肥飲食計畫時，請徵詢獸醫的建議，以確保計畫的科學性和可行性。";
            }

            $notify_url = 'https://notify-api.line.me/api/notify';
            $data = array('message' => $message);
            $options = array(
                'http' => array(
                    'header' => "Authorization: Bearer " . $line_notify_token . "\r\n" .
                        "Content-Type: application/x-www-form-urlencoded\r\n",
                    'method' => 'POST',
                    'content' => http_build_query($data)
                )
            );
            $context = stream_context_create($options);
            $result = file_get_contents($notify_url, false, $context);

            if ($result === FALSE) {
                echo "發送通知失敗\n";
            } else {
                echo "發送通知成功\n";
            }
        }
    }
} else {
    echo "沒有符合條件的數據\n";
}

$conn->close();
