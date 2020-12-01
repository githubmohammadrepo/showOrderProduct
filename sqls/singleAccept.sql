UPDATE `pish_hikashop_order_product`
SET pish_hikashop_order_product.vendor_id_accepted = (
    SELECT id
    FROM pish_phocamaps_marker_store
    WHERE pish_phocamaps_marker_store.user_id = 962
  )
WHERE pish_hikashop_order_product.order_product_id = 3350
  AND IF( (pish_hikashop_order_product.vendor_id_accepted), false, true )