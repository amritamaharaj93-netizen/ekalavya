<?php
$pdf_content = "%PDF-1.3\n1 0 obj\n<</Type/Catalog/Pages 2 0 R>>\nendobj\n2 0 obj\n<</Type/Pages/Kids[3 0 R]/Count 1>>\nendobj\n3 0 obj\n<</Type/Page/Parent 2 0 R/MediaBox[0 0 612 792]/Resources<</Font<</F1 4 0 R>>>>/Contents 5 0 R>>\nendobj\n4 0 obj\n<</Type/Font/Subtype/Type1/BaseFont/Helvetica>>\nendobj\n5 0 obj\n<</Length 50>>\nstream\nBT /F1 24 Tf 100 700 Td (EKALAVYA ACADEMY SAMPLE) Tj ET\nendstream\nendobj\ntrailer\n<</Root 1 0 R/Size 6>>\n%%EOF";
file_put_contents("uploads/materials/jee_maths_int.pdf", $pdf_content);
file_put_contents("uploads/materials/neet_phy_formula.pdf", $pdf_content);
file_put_contents("uploads/materials/organic_map.pdf", $pdf_content);
?>
