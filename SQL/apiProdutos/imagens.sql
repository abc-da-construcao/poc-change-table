-- busca imagens dos produtos na API de Produtos
SELECT
    referencia,
    (SELECT url from api_produtos.imagens pi where pi.position = 1 and pi.referencia = i.referencia and status = 'active' LIMIT 1) as img_1,
    (SELECT url from api_produtos.imagens pi where pi.position = 2 and pi.referencia = i.referencia and status = 'active' LIMIT 1) as img_2,
    (SELECT url from api_produtos.imagens pi where pi.position = 3 and pi.referencia = i.referencia and status = 'active' LIMIT 1) as img_3,
    (SELECT url from api_produtos.imagens pi where pi.position = 4 and pi.referencia = i.referencia and status = 'active' LIMIT 1) as img_4,
    (SELECT url from api_produtos.imagens pi where pi.position = 5 and pi.referencia = i.referencia and status = 'active' LIMIT 1) as img_5,
    (SELECT url from api_produtos.imagens pi where pi.position = 6 and pi.referencia = i.referencia and status = 'active' LIMIT 1) as img_6,
    (SELECT url from api_produtos.imagens pi where pi.position = 7 and pi.referencia = i.referencia and status = 'active' LIMIT 1) as img_7,
    (SELECT url from api_produtos.imagens pi where pi.position = 8 and pi.referencia = i.referencia and status = 'active' LIMIT 1) as img_8,
    (SELECT url from api_produtos.imagens pi where pi.position = 9 and pi.referencia = i.referencia and status = 'active' LIMIT 1) as img_9,
    (SELECT url from api_produtos.imagens pi where pi.position = 10 and pi.referencia = i.referencia and status = 'active' LIMIT 1) as img_10,
    (SELECT url from api_produtos.imagens pi where pi.position = 11 and pi.referencia = i.referencia and status = 'active' LIMIT 1) as img_11,
    (SELECT url from api_produtos.imagens pi where pi.position = 12 and pi.referencia = i.referencia and status = 'active' LIMIT 1) as img_12,
    (SELECT url from api_produtos.imagens pi where pi.position = 13 and pi.referencia = i.referencia and status = 'active' LIMIT 1) as img_13,
    (SELECT url from api_produtos.imagens pi where pi.position = 14 and pi.referencia = i.referencia and status = 'active' LIMIT 1) as img_14,
    (SELECT url from api_produtos.imagens pi where pi.position = 15 and pi.referencia = i.referencia and status = 'active' LIMIT 1) as img_15,
    i.created_at,
    i.updated_at
FROM api_produtos.imagens i
WHERE  1=1
AND ((i.updated_at IS NOT NULL and i.updated_at >= :timeStamp) OR (i.created_at >= :timeStamp))
GROUP BY i.referencia;
