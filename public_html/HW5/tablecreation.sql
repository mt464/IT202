CREATE TABLE BankAccounts (
	id int auto_increment,
	UserID int,
	AccountNumber varchar(12) NOT NULL,
	AccountType varchar(20),
	Balance decimal(12,2) default 0.00, 
	Modified DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	AccountCreated DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
)