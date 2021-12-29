create database DBS_project;
use DBS_project;
-- drop database DBS_project;

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
-- alter table `Member` AUTO_INCREMENT = 1; -- 重設id為1開始
-- select * from `Member`; -- 查詢 

create table Product(
	Product_ID int not null AUTO_INCREMENT,
	Product_name VARCHAR(50) not null,
	Price INT not null,
	`Status` INT not null,
	Publish_date DATETIME not null,
	Modified_date DATETIME,
    Product_descripition VARCHAR(2000),
    Product_standerd VARCHAR(2000),
	primary key (Product_ID)
);

insert into Product(Product_name, Price, `status`, Publish_date, Product_descripition, Product_standerd)
values("台中太陽餅30入裝", "750", 100, '2021-12-29',"好吃的太陽餅",
"品 名:太陽堂-太陽餅
成 份: 高級麵粉、糖、酥油、麥芽、奶粉、蜂蜜
淨 重:200g/盒X6盒
保存期限:2個月
保存溫度:請置於陰涼處，勿冰存以保風味
廠商名稱:太禓創意行銷有限公司
廠商地址：新北市汐止區忠孝東路487-1號1樓
投保產品責任險字號：0527第20AML0000061
食品業者登錄字號：F-145917082-00001-0");

-- delete from `Product` where Product_ID; -- 清空
-- alter table `Product` AUTO_INCREMENT = 1; -- 重設id為1開始
-- select * from Product;

create table Category(
	Product_ID int not null,
	Category_name VARCHAR(50) not null,
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



-- insert into Product_Image(Product_ID, Image_path) values(1,"./images/product2/9.jpg");
alter table `Product_Image` AUTO_INCREMENT = 1;
select * From Product_Image;
-- delete from Product_Image where Image_ID;

SELECT * FROM `Product` as P,`Product_Image` as PI Where P.Product_ID = 1 and P.Product_ID = PI.Product_ID;

create table Coupon(
	Coupon_ID int not null AUTO_INCREMENT,
	Coupon_Name VARCHAR(50) not null,
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
	Payment_method VARCHAR(20),
	Payment_Date DATETIME,
	Deliver_method VARCHAR(20),
    Deliver_address VARCHAR(100),
	Total_price INT,
	Discounted_price INT,
	Order_date DATETIME,
	Order_status INT not null,
	primary key (Order_ID),
	foreign key (Member_ID) references `Member`(Member_ID) on update cascade On delete cascade,
	foreign key (Coupon_ID) references Coupon(Coupon_ID) on update cascade on delete cascade
);



