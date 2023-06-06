-- busca imagens dos produtos na API de Produtos
SELECT
    a.id as 'id_atributos',
    a.referencia,
    a.nome,
    a.valor,
    a.filtravel,
    a.removido,
    a.slug_nome,
    a.slug_valor,
    a.created_at,
    a.updated_at
FROM atributos a
WHERE  1=1
AND ((a.updated_at IS NOT NULL and a.updated_at >= :timeStamp) OR (a.created_at >= :timeStampTwo));
