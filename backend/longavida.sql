create database gerenciador


create table usuarios(
       usu_codigo int primary key auto_increment,
       usu_nome varchar(255),
       usu_email varchar(255)
);

CREATE TABLE tarefas (
    tar_codigo INT PRIMARY KEY AUTO_INCREMENT,
    tar_setor VARCHAR(100),
    tar_prioridade ENUM('Baixa', 'Média', 'Alta'),
    tar_descricao TEXT,
    tar_status ENUM('Pendente', 'Em Andamento', 'Concluída'),
    tar_usu int,
    foreign key (tar_usu) references usuarios(usu_codigo)
);

