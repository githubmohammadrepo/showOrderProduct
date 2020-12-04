SELECT 
    id,user_id, 
    (
    6371*
    acos(cos(radians(29.807903289794923)) * 
    cos(radians(latitude)) * 
    cos(radians(longitude) - 
    radians(52.48660659790040)) + 
    sin(radians(29.807903289794923)) * 
    sin(radians(latitude)))
    ) AS distance 
    FROM pish_phocamaps_marker_store 
    HAVING user_id is not null And LENGTH(user_id)
    ORDER BY distance LIMIT 0, 20