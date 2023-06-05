-- busca complementos para produtos na API de Produtos
SELECT
    pd.codpro,
	pd.referencia as 'api_produtos_referencia',
	pd.modelo as 'api_produtos_modelo',
	pd.nome_original as 'api_produtos_nome_original',
	pd.venda_minima as 'api_produtos_venda_minima',
	pd.descricao_amigavel as 'api_produtos_descricao_amigavel',
	pd.nome_amigavel as 'api_produtos_nome_web',
	pd.descricao_longa as 'ap_produtos_descricao_longa',
	pd.embalagem as 'api_produtos_embalagem',
	pd.tags as 'api_produtos_tags',
	pd.obs as 'api_produtos_obs',
	substring(pd.url_video, 0, 254) as 'api_produtos_video',
	pd.created_at,
	pd.updated_at
FROM
	api_produtos.produtos pd
WHERE ((pd.updated_at IS NOT NULL and pd.updated_at >= :timeStamp) OR (pd.created_at >= :timeStamp));
