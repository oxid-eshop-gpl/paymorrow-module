SELECT OXID
INTO @SHOP_ID
FROM oxshops
ORDER BY OXID ASC
LIMIT 1;