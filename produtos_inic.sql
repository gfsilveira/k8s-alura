CREATE TABLE produtos (id integer auto_increment primary key, nome varchar(255), preco decimal(10,2));
ALTER TABLE produtos add column usado boolean default false;
ALTER TABLE produtos add column descricao varchar(255);
CREATE TABLE categorias (id integer auto_increment primary key, nome varchar(255));
insert into categorias (nome) values ("Futebol"), ("Volei"), ("Tenis");
ALTER TABLE produtos add column catgeoria_id integer;
update produtos set catgeoria_id = 1;