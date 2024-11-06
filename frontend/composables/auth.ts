export const useAuth = () => {

    const config = useSanctumConfig();
    const sanctumFetch = useSanctumClient()
    const { refreshIdentity, logout, login } = useSanctumAuth()

    const fullname = ref('')
    const email = ref('')
    const password = ref('')
    const passwordConfirmation = ref('')

    const processing = ref(false);
    const setProcessing = (value: boolean) => {
        processing.value = value
    }

    const validationErrors: Ref<Record<string, string[]> | null> = ref(null)
    const setValidationErrors = (value: Record<string, string[]>) => {
        validationErrors.value = value
    }

    const register = async () => {
        setProcessing(true);

        let data = {
            fullname: fullname.value,
            email: email.value,
            password: password.value,
            password_confirmation: passwordConfirmation.value
        }

        try {
            await sanctumFetch('/register', {
                method: 'POST',
                body: data,
            })

            await refreshIdentity()

            navigateTo(config.redirect.onLogin || '/dashboard')
        }
        catch (error) {
            const err = useSanctumError(error)

            if (err.isValidationError) {
                setValidationErrors(err.bag)
            }
        }
        setProcessing(false);
    }

    const processLogin = async () => {
        setProcessing(true)
        let credentials = {
            email: email,
            password: password
        }

        try {
            await login(credentials)
        }
        catch (error) {
            const err = useSanctumError(error)

            if (err.isValidationError) {
                setValidationErrors(err.bag)
            }
        }

        setProcessing(false)
    }

    return {
        fullname,
        email,
        password,
        passwordConfirmation,
        processing,
        validationErrors,
        register,
        logout
    }
}