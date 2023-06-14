
SELECT
        CONCAT(evp.orcamento_id, '-plataforma') as 'pedido_id',
        replace(replace(replace(TRIM(ee.documento), '.', ''), '-', ''), '/', '') as 'idEspecificadorMdm',
        CONCAT(evp.orcamento_id, '-plataforma') as 'especificador_vinc_ped_idPedidoMdm',
        evp.id as especificador_vinc_ped_id,
        evp.orcamento_id as especificador_vinc_ped_orcamento_id,
        evp.pedido_mu as especificador_vinc_ped_pedido_mu,
        evp.especificador_id as especificador_vinc_ped_especificador_id,
        evp.filial_id as especificador_vinc_ped_filial_id ,
        evp.status as especificador_vinc_ped_status,
        evp.created_at as especificador_vinc_ped_created_at,
        evp.updated_at as especificador_vinc_ped_updated_at
FROM especificadores_vincular_pedido evp
LEFT JOIN especificadores_especificador ee ON ee.id = evp.especificador_id
WHERE ((evp.updated_at IS NOT NULL AND evp.updated_at >= :timeStamp) OR (evp.created_at >= :timeStampD))