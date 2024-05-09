# bloombloom

## installing 

```bash
git clone https://github.com/ahmada3mar/bloombloom.git

cd .\bloombloom

composer install

```

## Run the migration and seeder

```bash
php artisan migrate --seed

````

## default credentials
**Admin**
```json
{
    "email":"admin@bloombloom.com",
    "password":"P@ssw0rd"
}
```
**User**
```json
{
    "email":"user@bloombloom.com",
    "password":"P@ssw0rd"
}
```

## Login 1: [POST] /api/login

**Parameters:**
- `email` (string): user email
- `password` (password): user password


## Admin APIs
For this assessment, the admin APIs will be used to manage the company’s inventory of Frames and Lenses.

### Frames
Please allow the admin user to create frames which have the following components:
- **Name**: string
- **Description**: text
- **Status**: `active`, `inactive`
- **Stock**: integer
- **Price**: float

### Lenses
Please allow the admin user to create lenses that have the following components:
- **Colour**: string
- **Description**: text
- **Prescription_type**: `fashion`, `single_vision`, `varifocal`
- **Lens_type**: `classic`, `blue_light`, `transition`
- **Stock**: integer
- **Price**: float

For the above objects, prices need to be unique per currency. For this exercise, we want to allow prices to be created in the following currencies:
- **USD**
- **GBP**
- **EUR**
- **JOD**
- **JPY**

## User APIs
The User APIs will allow the user to create a pair of glasses which will contain one frame and one pair of lenses and will have a price associated which is a function of the frame and lens prices.

### Requirements
- A user can only see **active frames**
- A user can view **all lenses**
- A user can create custom glasses by adding one frame and one pair of lenses and storing in the shopping basket
  - The price shown needs to be determined by the user’s currency
  - The user cannot create a glass if either the frame or lens are out of stock (Stock < 1). The user will get an error stating that the frame or lens is out of stock.

- When a user successfully creates a pair of glasses, the stock of the frame and the lens is subtracted by 1.
