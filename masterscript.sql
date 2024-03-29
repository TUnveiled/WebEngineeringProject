
create table User(
    emailAddress varchar(255),
    passwordHash varchar(255),
    administrator bit,
    primary key (emailAddress)
);

create table userToken(
    emailAddress varchar(255),
    token varchar(80),
    timemodified timestamp,
    primary key (emailAddress),
    foreign key (emailAddress) references User (emailAddress) on delete cascade
);

create table Seller(
    userEmail varchar(255),
    sellerName varchar(255),
    primary key (sellerName),
    foreign key (userEmail) references User (emailAddress) on delete cascade
);

create table Product(
    productID integer auto_increment,
    productName varchar(255),
    price double,
    stock integer,
    description varchar(511),
    manufacturer varchar(255),
    imageLink varchar(255),
    primary key (productID)
);

create table Listing(
    sellerName varchar(255),
    productID integer,
    primary key (sellerName, productID),
    foreign key (sellerName) references Seller (sellerName) on delete cascade,
    foreign key (productID) references Product (productID) on delete cascade
);

create table customerorder(
    orderID integer,
    buyerEmail varchar(255),
    sellerName varchar(255),
    productID integer,
    totalPrice double,
    sourceAddress varchar(255),
    custAddress varchar(255),
    primary key (orderID),
    foreign key (buyerEmail) references user (emailAddress) on delete cascade,
    foreign key (sellerName, productID) references listing (sellerName, productID) on delete cascade
);
