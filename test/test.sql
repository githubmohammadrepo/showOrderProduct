SELECT
  Category.*,
  pish_hikashop_product.*
FROM
  (
    SELECT
      *
    FROM
      pish_hikashop_product_category
    WHERE
      pish_hikashop_product_category.category_id = (
        4932
      )
  ) AS Category
  INNER JOIN pish_hikashop_product ON Category.product_id = pish_hikashop_product.product_id
WHERE
  pish_hikashop_product.product_quantity > 0