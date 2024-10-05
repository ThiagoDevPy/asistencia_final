<?php
session_start();
require '../config/conexion.php';
require 'phpqrcode/qrlib.php';
if (isset($_GET['id'])) {
   
    $id = $_SESSION['qr_id'];

    if (empty($id)) {
        echo json_encode(['error' => 'ID no válido.']);
        exit();
    }
    // Verificar en la base de datos
    $stmt = $conexion->prepare("SELECT * FROM qr WHERE qr_id = ? AND estado = 'no utilizado'");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Marcar como utilizado
        $stmt = $conexion->prepare("UPDATE qr SET estado = 'utilizado' WHERE qr_id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();

        // Generar un nuevo QR
        $new_id = uniqid();
        $_SESSION['qr_id'] = $new_id;
        $stmt = $conexion->prepare("INSERT INTO qr (qr_id, estado) VALUES (?, 'no utilizado')");
        $stmt->bind_param("s", $new_id);
        $stmt->execute();

        $new_qr_code_data = "https://asis.zeabur.app/guardardatos.php?id=" . $new_id;  // tiene que ser igual a la url del la pagina
        QRcode::png($new_qr_code_data, 'qrcodes/new_qr.png', QR_ECLEVEL_L, 10);

        echo json_encode(['new_qr' => "qrcodes/new_qr.png", 'new_id' => $new_id]);
        exit();
    } else {
        echo json_encode(['error' => 'ID no válido o ya ha sido utilizado.']);
        exit();
    }


}else {
    echo json_encode(['error' => 'No se proporcionó ID.']);
    exit();
}

?>