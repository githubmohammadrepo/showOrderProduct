SELECT pish_phocamaps_marker_store,pish_customer_vendor


SELECT tableNew.* from (
	SELECT pish_phocamaps_marker_store.*,pish_customer_vendor.*
  from pish_phocamaps_marker_store

  left join

  pish_customer_vendor

)