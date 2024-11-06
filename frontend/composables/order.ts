export const useOrder = () => {
    const sanctumFetch = useSanctumClient()
    const orders: Ref<Order[]> = ref([]);
    const setOrders = (value: Order[]) => {
        orders.value = value
    }

    const loading = ref(false);
    const setLoading = (value: boolean) => {
        loading.value = value
    }

    const productId = ref('')
    const quantity = ref(1)

    const resetForm = () => {
        productId.value = ''
        quantity.value = 1
    }

    const ENDPOINT = '/api/orders'

    const validation = useValidation()
    const { errors } = toRefs(validation);

    const getOrders = async () => {
        setLoading(true)

        const { data, error } = await sanctumFetch(ENDPOINT)

        setOrders(data)
        setLoading(false)
    }

    const createOrder = async () => {
        validation.resetErrors()
        setLoading(true)
        try {

            const data = {
                quantity: quantity.value,
                product_id: productId.value
            }

            await sanctumFetch(ENDPOINT, {
                method: 'post',
                body: data
            })

            resetForm()
        } catch (error) {
            const err = useSanctumError(error)

            if (err.isValidationError) {
                validation.setErrors(err.bag)
            }
        }
    }

    return { orders, loading, productId, quantity, errors, getOrders, createOrder }
}