
SELECT 
    REPLACE(REPLACE(REPLACE(TRIM(c.documento), '.', ''), '-', ''), '/', '') as 'cpf_cnpj', 
    e.cep, 
    e.numero, 
    CONCAT(CONCAT(REPLACE(e.cep, '-', ''), REPLACE((TRIM(e.numero)), ' ', '')), REPLACE(REPLACE(REPLACE(TRIM(c.documento), '.', ''), '-', ''), '/', '')) as 'id_endereco_mdm', 
    e.clientes_id as plataforma_clientes_id, 
    e.oid_cliente as plataforma_oid_cliente, 
    e.oid_endereco as plataforma_oid_endereco, 
    e.oid_classificacao as plataforma_oid_classificacao, 
    e.destinatario as plataforma_destinatario, 
    e.cep as plataforma_cep, 
    e.endereco as plataforma_endereco, 
    e.numero as plataforma_numero, 
    e.complemento as plataforma_complemento, 
    e.bairro as plataforma_bairro, 
    e.cidade as plataforma_cidade, 
    e.estado as plataforma_estado, 
    e.referencia as plataforma_referencia, 
    e.tipo as plataforma_tipo, 
    e.principal as plataforma_principal, 
    e.mesmo as plataforma_mesmo, 
    e.oid_cidade as plataforma_oid_cidade, 
    e.oid_estado as plataforma_oid_estado 
FROM enderecos AS e 
  LEFT JOIN clientes AS c ON e.clientes_id = c.id 
WHERE ((e.updated_at IS NOT NULL and e.updated_at >= :timeStamp) OR (e.created_at >= :timeStampD))
  AND (
       c.documento IS NOT NULL  OR 
       c.documento <> '' OR 
       c.documento <> ' '
  );