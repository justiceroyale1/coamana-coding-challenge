export const useProduct = () => {
    const sanctumFetch = useSanctumClient()
    const products: Ref<Product[]> = ref([]);
    const setProducts = (value: Product[]) => {
        products.value = value
    }

    const loading = ref(false);
    const setLoading = (value: boolean) => {
        loading.value = value
    }

    const getProducts = async () => {
        setLoading(true)

        sanctumFetch(`/api/products`).then(data => {

            console.log('data', data)
            setProducts(data)
        }).catch(error => { console.error(error) })

        setLoading(false)
    }

    return { products, loading, getProducts }
}