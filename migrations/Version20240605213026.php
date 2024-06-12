<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240605213026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE act (id INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT \'Идентификатор\', contract_id INT UNSIGNED NOT NULL COMMENT \'Номер договора\', buyer VARCHAR(255) NOT NULL COMMENT \'ФИО покупателя\', seller VARCHAR(255) NOT NULL COMMENT \'ФИО продавца\', vehicle_brand VARCHAR(255) NOT NULL COMMENT \'Марка\', vehicle_model VARCHAR(255) NOT NULL COMMENT \'Модель\', year_of_manufacture DATE NOT NULL COMMENT \'Дата изготовления\', passport_series VARCHAR(4) NOT NULL COMMENT \'Серия ПТС\', passport_number INT NOT NULL COMMENT \'Номер ПТС\', passport_date DATE NOT NULL COMMENT \'Дата выдачи ПТС\', vin VARCHAR(17) NOT NULL COMMENT \'Идентификационный номер транспорта\', bodywork_number VARCHAR(17) NOT NULL COMMENT \'Номер кузова\', engine_number VARCHAR(255) NOT NULL COMMENT \'Номер двигателя\', vehicle_color VARCHAR(255) NOT NULL COMMENT \'Цвет кузова\', INDEX contract_id_idx1 (contract_id), INDEX contract_id_idx2 (contract_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE article (id INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT \'Уникальный идентификатор артикля\', description VARCHAR(255) NOT NULL COMMENT \'Описание артикула\', cost DOUBLE PRECISION UNSIGNED NOT NULL COMMENT \'Стоимость продукта данного артикула\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE bills_of_lading (id INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT \'Идентификатор\', recipient VARCHAR(255) NOT NULL COMMENT \'Грузополучатель\', buyer VARCHAR(255) NOT NULL COMMENT \'ФИО покупателя\', seller VARCHAR(255) NOT NULL COMMENT \'ФИО продавца\', contract_id BIGINT UNSIGNED NOT NULL COMMENT \'Номер договора\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE contract (id INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT \'Идентификатор\', contract_number INT UNSIGNED NOT NULL COMMENT \'Номер договора\', status VARCHAR(255) DEFAULT NULL COMMENT \'Статус договора\', contract_date DATE NOT NULL COMMENT \'Дата подписания договора\', amount DOUBLE PRECISION UNSIGNED NOT NULL COMMENT \'Сумма к оплате по договору\', paid DOUBLE PRECISION UNSIGNED NOT NULL COMMENT \'Сумма оплаченная по договору\', buyer_id INT DEFAULT NULL COMMENT \'Идентификатор\', contragent_id INT DEFAULT NULL, INDEX IDX_E98F28596C755722 (buyer_id), INDEX IDX_E98F285994E8DE86 (contragent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE contract_item (id INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT \'Идентификатор\', contract_id INT UNSIGNED NOT NULL COMMENT \'Идентификатор\', vehicle_id INT UNSIGNED DEFAULT NULL COMMENT \'Идентификатор\', INDEX IDX_776E6B762576E0FD (contract_id), INDEX IDX_776E6B76545317D1 (vehicle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE contract_status (id INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT \'Идентификатор\', contract_id BIGINT UNSIGNED NOT NULL COMMENT \'Номер договора\', status_change DATETIME NOT NULL COMMENT \'Дата смены статуса\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE legal (id INT AUTO_INCREMENT NOT NULL COMMENT \'Идентификатор\', name VARCHAR(255) NOT NULL COMMENT \'Название юридического лица\', inn VARCHAR(12) NOT NULL COMMENT \'ИНН юридического лица\', ogrn VARCHAR(13) NOT NULL COMMENT \'ОГРН юридического лица\', kpp VARCHAR(9) NOT NULL COMMENT \'КПП юридического лица\', address VARCHAR(255) NOT NULL COMMENT \'Адрес юридического лица\', phone VARCHAR(20) NOT NULL COMMENT \'Телефон юридического лица\', email VARCHAR(255) NOT NULL COMMENT \'Электронная почта\', registration_date DATE NOT NULL COMMENT \'Дата регистрации\', ownership_form VARCHAR(255) NOT NULL, director VARCHAR(255) NOT NULL, accountant VARCHAR(255) NOT NULL, bank_name VARCHAR(255) DEFAULT NULL, bik VARCHAR(9) DEFAULT NULL, correspondent_account VARCHAR(20) DEFAULT NULL, checking_account VARCHAR(20) DEFAULT NULL, UNIQUE INDEX UNIQ_E362C050E93323CB (inn), UNIQUE INDEX UNIQ_E362C050B89AB2C7 (ogrn), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE payment_order (id INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT \'Идентификатор\', buyer VARCHAR(255) NOT NULL COMMENT \'ФИО покупателя\', buyer_bank VARCHAR(255) NOT NULL COMMENT \'Банк покупателя\', seller VARCHAR(255) NOT NULL COMMENT \'ФИО продавца\', seller_bank VARCHAR(255) NOT NULL COMMENT \'Банк продавца\', summ DOUBLE PRECISION UNSIGNED NOT NULL COMMENT \'Сумма требуемая от покупателя\', contract_id BIGINT UNSIGNED NOT NULL COMMENT \'Номер договора\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, is_active TINYINT(1) NOT NULL, first_name VARCHAR(128) NOT NULL, patronymic VARCHAR(128) DEFAULT NULL, last_name VARCHAR(128) NOT NULL, email VARCHAR(180) DEFAULT NULL, login VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_LOGIN (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE vehicle (id INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT \'Идентификатор\', vin VARCHAR(17) NOT NULL COMMENT \'Идентификационный номер транспорта\', vehicle_brand VARCHAR(255) NOT NULL COMMENT \'Марка\', vehicle_model VARCHAR(255) NOT NULL COMMENT \'Модель\', type VARCHAR(255) NOT NULL COMMENT \'Тип транспорта\', category VARCHAR(255) NOT NULL COMMENT \'Категория транспорта\', year_of_manufacture DATE NOT NULL COMMENT \'Дата изготовления\', engine_model VARCHAR(255) NOT NULL COMMENT \'Модель двигателя\', engine_number VARCHAR(255) NOT NULL COMMENT \'Номер двигателя\', chassis_number VARCHAR(255) NOT NULL COMMENT \'Номер шасси\', bodywork_number VARCHAR(17) NOT NULL COMMENT \'Номер кузова\', vehicle_color VARCHAR(255) NOT NULL COMMENT \'Цвет кузова\', engine_power INT UNSIGNED NOT NULL COMMENT \'Мощность двигателя\', engine_capacity INT UNSIGNED NOT NULL COMMENT \'Объём двигателя\', engine_type VARCHAR(255) NOT NULL COMMENT \'Тип двигателя\', mass INT UNSIGNED NOT NULL COMMENT \'Масса без нагрузки\', manufacturer VARCHAR(255) NOT NULL COMMENT \'Организация-изготовитель\', article_id INT UNSIGNED NOT NULL COMMENT \'Номер артикула\', in_date DATETIME NOT NULL COMMENT \'Дата поступления на склад\', out_date DATETIME DEFAULT NULL COMMENT \'Дата отгрузки\', status INT UNSIGNED DEFAULT 1 COMMENT \'Статус. 1 - доступен к продаже, 2 - забронирован, 3 - отгружен\', contract_item_id INT UNSIGNED DEFAULT NULL COMMENT \'Идентификатор\', UNIQUE INDEX UNIQ_1B80E4861A3E2F96 (contract_item_id), INDEX IDX_1B80E4867294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE contract ADD CONSTRAINT FK_E98F28596C755722 FOREIGN KEY (buyer_id) REFERENCES legal (id)');
        $this->addSql('ALTER TABLE contract ADD CONSTRAINT FK_E98F285994E8DE86 FOREIGN KEY (contragent_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE contract_item ADD CONSTRAINT FK_776E6B762576E0FD FOREIGN KEY (contract_id) REFERENCES contract (id)');
        $this->addSql('ALTER TABLE contract_item ADD CONSTRAINT FK_776E6B76545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E4861A3E2F96 FOREIGN KEY (contract_item_id) REFERENCES contract_item (id)');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E4867294869C FOREIGN KEY (article_id) REFERENCES article (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contract DROP FOREIGN KEY FK_E98F28596C755722');
        $this->addSql('ALTER TABLE contract DROP FOREIGN KEY FK_E98F285994E8DE86');
        $this->addSql('ALTER TABLE contract_item DROP FOREIGN KEY FK_776E6B762576E0FD');
        $this->addSql('ALTER TABLE contract_item DROP FOREIGN KEY FK_776E6B76545317D1');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E4861A3E2F96');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E4867294869C');
        $this->addSql('DROP TABLE act');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE bills_of_lading');
        $this->addSql('DROP TABLE contract');
        $this->addSql('DROP TABLE contract_item');
        $this->addSql('DROP TABLE contract_status');
        $this->addSql('DROP TABLE legal');
        $this->addSql('DROP TABLE payment_order');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vehicle');
    }
}
