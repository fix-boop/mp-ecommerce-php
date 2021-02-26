<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Success</title>
<script src="https://www.mercadopago.com/v2/security.js" view=""></script>
</head>
<body>
<p>EXTERNAL REFERENCE: <?php echo isset($_GET['external_reference']) ? $_GET['external_reference'] : '';?></p>
<p>PAYMENT ID: <?php echo isset($_GET['collection_id']) ? $_GET['collection_id'] : '';?></p>
<p>PAYMENT TYPE: <?php echo isset($_GET['payment_type']) ? $_GET['payment_type'] : '';?></p>
<p>SUCCESS</p>
</body>
</html>