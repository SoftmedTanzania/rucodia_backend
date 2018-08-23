select distinct users.firstname, MAX(transactions.price) from transactions 
inner join users on users.id = transactions.user_id 
inner join products on products.id = transactions.product_id 
inner join transactiontypes on transactiontypes.id = 1 
inner join product_subcategory on product_subcategory.product_id = products.id
inner join subcategories on product_subcategory.subcategory_id = subcategories.id
inner join user_ward on user_ward.user_id = users.id 
inner join wards on wards.id = user_ward.ward_id
inner join districts on wards.district_id = districts.id
where districts.name like 'Kigoma Mjini'
group by users.firstname;