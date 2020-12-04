(SELECT 
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
    WHERE user_id is not null AND user_id REGEXP '^[0-9]' AND city = 288 AND province = 20
    ORDER BY distance LIMIT 0, 40
    )