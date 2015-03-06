<?php
namespace TYPO3\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
	Doctrine\DBAL\Schema\Schema;

/**
 * Add "vendor" entity
 */
class Version20150207143234 extends AbstractMigration {

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function up(Schema $schema) {
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

		$this->addSql("CREATE TABLE wwwision_neos_vendors_domain_model_vendor (persistence_object_identifier VARCHAR(40) NOT NULL, owner VARCHAR(40) DEFAULT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_C7A43C94CF60E67C (owner), PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
		$this->addSql("ALTER TABLE wwwision_neos_vendors_domain_model_vendor ADD CONSTRAINT FK_C7A43C94CF60E67C FOREIGN KEY (owner) REFERENCES wwwision_neos_frontendlogin_domain_model_user (persistence_object_identifier)");
	}

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function down(Schema $schema) {
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

		$this->addSql("DROP TABLE wwwision_neos_vendors_domain_model_vendor");
	}
}