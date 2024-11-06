export const useAuth = () => {

    const config = useSanctumConfig();
    const sanctumFetch = useSanctumClient()
    const { refreshIdentity, logout, login } = useSanctumAuth()

    const fullname = ref('')
    const email = ref('')
    const password = ref('')
    const passwordConfirmation = ref('')
    const remember = ref(false)

    const processing = ref(false);
    const setProcessing = (value: boolean) => {
        processing.value = value
    }

    const validation = useValidation()
    const { errors } = toRefs(validation);

    const register = async () => {
        validation.resetErrors()
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
                validation.setErrors(err.bag)
            }
        }
        setProcessing(false);
    }

    const processLogin = async () => {
        validation.resetErrors()
        setProcessing(true)
        let credentials = {
            email: email.value,
            password: password.value,
            remember: remember.value
        }

        try {
            await login(credentials)
        }
        catch (error) {
            const err = useSanctumError(error)

            if (err.isValidationError) {
                validation.setErrors(err.bag)
            }
        }

        setProcessing(false)
    }

    return {
        fullname,
        email,
        password,
        passwordConfirmation,
        remember,
        processing,
        errors,
        register,
        logout,
        processLogin,
    }
}