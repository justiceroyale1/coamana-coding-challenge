interface ValidationError {
    path: string,
    message: string
}

interface User {
    created_at: string
    email: string
    email_verified_at: string | null
    fullname: string
    id: number
    updated_at: string
}

interface Order {
    id: string,
    order_number: string,
    username: string,
    product: string,
    amount: string,
    quantity: string,
    created_at: string,
}

interface Product {
    id: string,
    name: string,
}