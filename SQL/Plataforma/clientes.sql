SELECT 
    REPLACE(REPLACE(REPLACE(TRIM(c.documento), '.', ''), '-', ''), '/', '') as 'cpf_cnpj',
    REPLACE(REPLACE(REPLACE(TRIM(c.documento), '.', ''), '-', ''), '/', '') as 'idClienteMDM',
    CONCAT(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE((UPPER(REPLACE(TRIM(c.nome), ' ', ''))), 'Á','A'), 'À','A'), 'Ã','A'), 'Â','A'), 'É','E'), 'È','E'), 'Ê','E'), 'Í','I'), 'Ì','I'), 'Î','I'), 'Ó','O'), 'Ò','O'), 'Ô','O'), 'Õ','O'), 'Ú','U'), 'Ù','U'), 'Û','U'), 'Ü','U'), 'Ç','C'), REPLACE(REPLACE(REPLACE(REPLACE(IFNULL(IFNULL(c.celular, c.telefone), c.email), '(', ''), ')', ''), '-', ''), ' ', '') )  as 'idLeadMdm',
    case when documento is null then 'LEAD' else 'CLIENTE' end as 'tipoRegistro',
    c.oid AS plataforma_oid,
    c.documento AS plataforma_documento,
    c.nome AS plataforma_nome,
    c.nasc AS plataforma_nasc,
    c.pessoa AS plataforma_pessoa,
    c.email AS plataforma_email,
    c.telefone AS plataforma_telefone,
    c.celular AS plataforma_celular,
    c.inscricao AS plataforma_inscricao,
    c.contribuinte_icms AS plataforma_contribuinte_icms,
    c.contato AS plataforma_contato,
    c.etapa AS plataforma_etapa, 
    c.user_id AS plataforma_user_id,
    c.origem_id AS plataforma_origem_id,
    c.possui_especificador AS plataforma_possui_especificador,
    c.especificador_nome AS plataforma_especificador_nome,
    c.especificador_telefone AS plataforma_especificador_telefone,
    c.tipo_obra AS plataforma_tipo_obra,
    u.name as 'NomeUserPv', 
    u.nome_original as 'NomeOrigUserPv',	
    u.filial_id as 'filial_id_user_cad', 
    f.nome as 'filial_user_cad',
    u.id as 'idUserPv',
    u.`user` as 'idUserMu'
FROM clientes c 
LEFT JOIN users u ON c.user_id = u.id  
LEFT JOIN filiais f ON f.id = u.filial_id 
WHERE ((c.updated_at IS NOT NULL and c.updated_at >= :timeStamp) OR (c.created_at >= :timeStampD))
