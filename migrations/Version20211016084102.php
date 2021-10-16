<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211016084102 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE celebrity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, birthday DATE NOT NULL, bio VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE celebrity_representative (id INT AUTO_INCREMENT NOT NULL, celebrity_id INT NOT NULL, representative_id INT NOT NULL, representative_type_id INT DEFAULT NULL, territory VARCHAR(255) DEFAULT NULL, INDEX IDX_3B9810D6B7C621DD (celebrity_id), INDEX IDX_3B9810D68D510F91 (representative_type_id), INDEX IDX_3B9810D6C01675FE (representative_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE logs (id INT AUTO_INCREMENT NOT NULL, section VARCHAR(255) NOT NULL, action VARCHAR(255) NOT NULL, user_id INT NOT NULL, created DATETIME NOT NULL, modified DATETIME NOT NULL, extra JSON DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE representative (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, company VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE representative_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE celebrity_representative ADD CONSTRAINT FK_3B9810D68D510F91 FOREIGN KEY (representative_type_id) REFERENCES representative_type (id)');
        $this->addSql('ALTER TABLE celebrity_representative ADD CONSTRAINT FK_3B9810D69D12EF95 FOREIGN KEY (celebrity_id) REFERENCES celebrity (id)');
        $this->addSql('ALTER TABLE celebrity_representative ADD CONSTRAINT FK_3B9810D6FC3FF006 FOREIGN KEY (representative_id) REFERENCES representative (id)');
        $this->addSql("INSERT INTO `representative_type` (`id`, `name`) VALUES(1, 'agent'), (2, 'publicist'),(3, 'manager');");
        $this->addSql("INSERT INTO `user` (`id`, `username`, `roles`, `password`) VALUES (1, 'admin', '[]', '21232f297a57a5a743894a0e4a801fc3');");
        $this->addSql("INSERT INTO `celebrity` (`id`, `name`, `birthday`, `bio`) VALUES (1, 'Celebrity 1', '2021-10-04', 'Celebrity bio'), (2, 'Celebrity 2', '2021-10-04', 'Celebrity bio'), (3, 'Celebrity 3', '2021-10-04', 'Celebrity bio'), (4, 'Celebrity 4', '2021-10-04', 'Celebrity bio'), (5, 'Celebrity 5', '2021-10-04', 'Celebrity bio')");
        $this->addSql("INSERT INTO `representative` (`id`, `name`, `company`, `email`) VALUES (1, 'Rep 1', 'test company', 'test@test.com'), (2, 'Rep 2', 'company', 'test2@test.com'), (3, 'Rep 3', 'company', 'test3@test.com');");
        $this->addSql("INSERT INTO `celebrity_representative` (`id`, `celebrity_id`, `representative_id`, `representative_type_id`, `territory`) VALUES (1, 1, 1, 3, 'Zone1'), (2, 1, 2, 2, 'Zone2'), (3, 1, 3, 1, ''), (4, 2, 2, 2, 'Zone1'), (5, 3, 1, 2, 'Zone2');");
        $this->addSql("INSERT INTO `logs` (`id`, `section`, `action`, `user_id`, `created`, `modified`, `extra`) VALUES (1, 'Celebrity', 'update', 2, '2021-10-16 13:15:22', '2021-10-16 13:15:22', '[]'), (2, 'CelebrityRepresentative', 'remove', 2, '2021-10-16 13:15:22', '2021-10-16 13:15:22', '[]'), (3, 'CelebrityRepresentative', 'add', 2, '2021-10-16 13:15:22', '2021-10-16 13:15:22', '[]'), (4, 'CelebrityRepresentative', 'add', 2, '2021-10-16 13:15:22', '2021-10-16 13:15:22', '[]'), (9, 'CelebrityRepresentative', 'remove', 2, '2021-10-16 13:15:22', '2021-10-16 13:15:22', '[]'), (10, 'CelebrityRepresentative', 'add', 2, '2021-10-16 13:15:22', '2021-10-16 13:15:22', '[]');");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE celebrity_representative DROP FOREIGN KEY FK_3B9810D69D12EF95');
        $this->addSql('ALTER TABLE celebrity_representative DROP FOREIGN KEY FK_3B9810D6FC3FF006');
        $this->addSql('ALTER TABLE celebrity_representative DROP FOREIGN KEY FK_3B9810D68D510F91');
        $this->addSql('DROP TABLE celebrity');
        $this->addSql('DROP TABLE celebrity_representative');
        $this->addSql('DROP TABLE logs');
        $this->addSql('DROP TABLE representative');
        $this->addSql('DROP TABLE representative_type');
        $this->addSql('DROP TABLE user');
    }
}
