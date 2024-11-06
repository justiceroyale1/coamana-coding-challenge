import { FetchError } from 'ofetch'

const VALIDATION_ERROR_CODE = 422
const SERVER_ERROR_CODE = 500

export const useSanctumError = (error: unknown) => {
    const isFetchError = error instanceof FetchError
    const isValidationError
        = isFetchError && error.response?.status === VALIDATION_ERROR_CODE

    const code = isFetchError ? error.response?.status : SERVER_ERROR_CODE

    const bag = isValidationError
        ? error.response?._data.errors
        : []

    return {
        isValidationError,
        code,
        bag,
    }
}