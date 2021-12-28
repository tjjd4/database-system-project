create database DBS_project;
use DBS_project;

create table `Member`(
	`Member_ID` int not null AUTO_INCREMENT,
	`Member_name` VARCHAR(255) not null,
	`Username` VARCHAR(50) not null UNIQUE,
	`Member_password` VARCHAR(50) not null,
	`Email` VARCHAR(255) not null,
	`Phone` int not null,
	primary key(Member_ID)
);

-- describe `Member`;
-- delete from `Member` where member_ID; -- 清空
-- alter table `Member` AUTO_INCREMENT = 0; -- 重設id為1開始
-- select * from `Member`; -- 查詢

create table Product(
	Product_ID int not null AUTO_INCREMENT,
	Product_name VARCHAR(6) not null,
	Price INT not null,
	`Status` INT not null,
	Publish_date DATETIME not null,
	Modified_date DATETIME,
	primary key (Product_ID)
);

create table Category(
	Product_ID int not null,
	Category_name VARCHAR(6) not null,
	primary key (Product_ID) ,
	foreign key (Product_ID) references Product(Product_ID) on update cascade on delete cascade
);

create table Product_Image(
	Image_ID int not null AUTO_INCREMENT,
	Product_ID int not null,
	Image_path VARCHAR(255) not null,
	primary key (Image_ID, Product_ID),
	foreign key (Product_ID) references Product(Product_ID) on update cascade on delete cascade
);

create table Coupon(
	Coupon_ID int not null AUTO_INCREMENT,
	Coupon_Name VARCHAR(6) not null,
	DiscountCount INT not null,
	StartDate Datetime not null,
	EndDate Datetime not null,
	primary key (Coupon_ID)
);

create table ShoppingCart(
	Member_ID int not null,
    Product_ID int not null,
	Product_amount INT not null,
	primary key (Member_ID),
	foreign key (Member_ID) references `Member`(Member_ID) on update cascade on delete cascade,
    foreign key (Product_ID) references Product(Product_ID) on update cascade on delete cascade
);

create table `Order`(
	Order_ID int not null AUTO_INCREMENT, 
	Member_ID int not null,
	Coupon_ID int not null,
	Payment_method VARCHAR(6),
	Payment_Date DATETIME,
	Deliver_method VARCHAR(6),
	Total_price INT,
	Discounted_price INT,
	Order_date DATETIME,
	Order_status INT not null,
	primary key (Order_ID),
	foreign key (Member_ID) references `Member`(Member_ID) on update cascade On delete cascade,
	foreign key (Coupon_ID) references Coupon(Coupon_ID) on update cascade on delete cascade
);



