@if(session()->has("messages"))
	<script>
        let messageType = "{{ session("messages.type") }}"
        let messageBody = "{{ session("messages.body") }}"

        let notifier = new AWN({
	        durations: "{{ session("messages.duration") }}",
        })

        const alertTypeLookupTable = {
            info: () => notifier.info(messageBody),
	        success: () => notifier.success(messageBody),
	        warning: () => notifier.warning(messageBody),
	        alert: () => notifier.alert(messageBody)
        }

        alertTypeLookupTable[messageType]()
	</script>
@endif
