SELECT pish_hikashop_product_category.category_id FROM pish_hikashop_product_category WHERE pish_hikashop_product_category.product_id = 8750




SELECT Category.*,pish_hikashop_product.* FROM (SELECT * FROM pish_hikashop_product_category WHERE pish_hikashop_product_category.category_id = (SELECT pish_hikashop_category.category_id FROM pish_hikashop_category WHERE pish_hikashop_category.category_id IN ( SELECT pish_hikashop_product_category.category_id FROM pish_hikashop_product_category WHERE pish_hikashop_product_category.product_id = 8750) AND pish_hikashop_category.category_type = 'product')) AS Category INNER JOIN pish_hikashop_product ON Category.product_id = pish_hikashop_product.product_id

$sql = "SELECT Category.*,pish_hikashop_product.* FROM (SELECT * FROM pish_hikashop_product_category WHERE pish_hikashop_product_category.category_id = (SELECT pish_hikashop_category.category_id FROM pish_hikashop_category WHERE pish_hikashop_category.category_id IN ( SELECT pish_hikashop_product_category.category_id FROM pish_hikashop_product_category WHERE pish_hikashop_product_category.product_id = 8750) AND pish_hikashop_category.category_type = \'product\')) AS Category\n"

    . "INNER JOIN\n"

    . "pish_hikashop_product\n"

    . "ON Category.product_id = pish_hikashop_product.product_id";
