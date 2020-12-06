SELECT Category.*,
  pish_hikashop_product.*
FROM (
    SELECT *
    FROM pish_hikashop_product_category
    WHERE pish_hikashop_product_category.category_id = (
        SELECT pish_hikashop_category.category_id
        FROM pish_hikashop_category
        WHERE pish_hikashop_category.category_id IN (
            SELECT pish_hikashop_product_category.category_id
            FROM pish_hikashop_product_category
            WHERE pish_hikashop_product_category.product_id = 8750
          )
          AND pish_hikashop_category.category_type = 'product'
      )
  ) AS Category
  INNER JOIN pish_hikashop_product ON Category.product_id = pish_hikashop_product.product_id
WHERE pish_hikashop_product.product_quantity > 0