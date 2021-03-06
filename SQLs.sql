CREATE SCHEMA `fitcard` DEFAULT CHARACTER SET utf8;

USE fitcard;

CREATE TABLE `fitcard`.`fit_categorias` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `categoria` VARCHAR(35) NOT NULL,
    PRIMARY KEY (`id`))
ENGINE = InnoDB;

INSERT INTO fit_categorias(categoria) VALUES('Supermercado'), 
                                            ('Restaurante'), 
                                            ('Borracharia'), 
                                            ('Posto'), 
                                            ('Oficina');

CREATE TABLE `fitcard`.`fit_estados` (
    `sigla` CHAR(2) NOT NULL,
    `estado` VARCHAR(35) NOT NULL,
    PRIMARY KEY (`sigla`))
ENGINE = InnoDB;

INSERT INTO fit_estados(sigla, estado) VALUES   ('AC', 'Acre'),
                                                ('AL', 'Alagoas'),
                                                ('AP', 'Amapá'),
                                                ('AM', 'Amazonas'),
                                                ('BA', 'Bahia'),
                                                ('CE', 'Ceará'),
                                                ('DF', 'Distrito Federal'),
                                                ('ES', 'Espírito Santo'),
                                                ('GO', 'Goiás'),
                                                ('MA', 'Maranhão'),
                                                ('MT', 'Mato Grosso'),
                                                ('MS', 'Mato Grosso do Sul'),
                                                ('MG', 'Minas Gerais'),
                                                ('PA', 'Pará'),
                                                ('PB', 'Paraíba'),
                                                ('PR', 'Paraná'),
                                                ('PE', 'Pernambuco'),
                                                ('PI', 'Piauí'),
                                                ('RJ', 'Rio de Janeiro'),
                                                ('RN', 'Rio Grande do Norte'),
                                                ('RS', 'Rio Grande do Sul'),
                                                ('RO', 'Rondonia'),
                                                ('RR', 'Roraima'),
                                                ('SC', 'Santa Catarina'),
                                                ('SP', 'São Paulo'),
                                                ('SE', 'Sergipe'),
                                                ('TO', 'Tocantins'),
                                                ('NN', 'Outros');

CREATE TABLE `fitcard`.`fit_estabelecimentos` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `siglaEstado` CHAR(2) NULL,
    `idCategoria` INT(11) NULL,
    `razaoSocial` VARCHAR(150) NOT NULL,
    `nomeFantasia` VARCHAR(150) NULL,
    `cnpj` CHAR(18) NOT NULL,
    `email` VARCHAR(100) NULL,
    `rua` VARCHAR(100) NULL,
    `numero` INT(11) NULL,
    `complemento` VARCHAR(70) NULL,
    `telefone` VARCHAR(14) NULL,
    `cidade` VARCHAR(80) NULL,
    `ativo` BIT NOT NULL DEFAULT 1,
    `dataCadastro` CHAR(10) NOT NULL,
    `horaCadastro` CHAR(8) NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `FK_estabelecimento_estado_idx` (`siglaEstado` ASC),
    UNIQUE INDEX `UK_cnpj` (`cnpj` ASC),
    UNIQUE INDEX `UK_razao_fantasia` (`razaoSocial` ASC, `nomeFantasia` ASC),
    CONSTRAINT `FK_estabelecimento_estado`
        FOREIGN KEY (`siglaEstado`)
        REFERENCES `fitcard`.`fit_estados` (`sigla`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
    CONSTRAINT `FK_estabelecimento_categoria`
        FOREIGN KEY (`idCategoria`)
        REFERENCES `fitcard`.`fit_categorias` (`id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE `fitcard`.`fit_contas` (
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `idEstabelecimento` INT(11) NOT NULL,
    `agencia` CHAR(5) NOT NULL,
    `conta` CHAR(8) NOT NULL,
    INDEX `FK_contas_estabelecimento_idx` (`idEstabelecimento` ASC),
    CONSTRAINT `FK_contas_estabelecimento`
        FOREIGN KEY (`idEstabelecimento`)
        REFERENCES `fitcard`.`fit_estabelecimentos` (`id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
ENGINE = InnoDB;