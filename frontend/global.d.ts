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