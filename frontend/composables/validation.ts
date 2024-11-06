export const useValidation = () => {
    const errors: Ref<Record<string, string[]> | null> = ref(null)
    const setErrors = (value: Record<string, string[]> | null) => {
        errors.value = value
    }

    const resetErrors = () => {
        setErrors(null)
    }

    return {
        errors,
        setErrors,
        resetErrors
    }
}