/** ==================================================================================== */
/** ===========================  CONTEXTO ESTOQUE INDUSTRIA ============================ */
/** ==================================================================================== */
SELECT
    e.referencia as 'apiProd_referencia',
    e.disponibilidade as 'apiProd_disponibilidade',
    CASE
        when e.atualizado_em >= NOW() - INTERVAL 45 DAY
        then IFNULL((SELECT sum(ee.quantidade)
                    FROM api_produtos.estoques ee
                    WHERE e.referencia = ee.referencia
                    AND ee.disponibilidade = 'ENCOMENDA'
                    AND ee.atualizado_em >= CURDATE() - INTERVAL 45 DAY), 0)
        else 0
    end as 'apiProd_estoque_industria_plan',
    prazo as 'apiProd_lead_time_plan',
    e.fornecedor as 'apiProd_fornecedor',
    e.codprofabricante as 'apiProd_codpro_fab',
    e.atualizado_em as 'apiProd_updated_at'
FROM estoques e
WHERE e.disponibilidade = 'ENCOMENDA' and e.prazo > 0
AND ((e.atualizado_em IS NOT NULL and e.atualizado_em >= :timeStamp))
GROUP BY
e.referencia,
e.disponibilidade,
e.prazo,
e.fornecedor,
e.codprofabricante,
e.atualizado_em;
