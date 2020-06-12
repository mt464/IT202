CREATE TABLE BankAccounts (
	PersonID int,
	AccountNumber int(12),
	FirstName varchar(25),
	LastName varchar(25),
	Amount double(13,2),
	Recent DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	AccountCreated DATETIME DEFAULT CURRENT_TIMESTAMP
	PRIMARY KEY (PersonID)
);