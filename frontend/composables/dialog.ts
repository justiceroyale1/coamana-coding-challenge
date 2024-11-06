export const useDialog = () => {
    const dialogToggle = ref(false)

    const setDialog = (value: boolean) => {
        dialogToggle.value = value
    }

    const open = () => {
        setDialog(true)
    }

    const close = () => {
        setDialog(false)
    }

    return {
        dialogToggle,
        open,
        close
    }
}