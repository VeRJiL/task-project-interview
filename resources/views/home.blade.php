@extends("layouts.master")

@section("title") Managing Tasks @endsection

@push("styles")
	<style>
        body {
            font-family: "Benton Sans", "Helvetica Neue", helvetica, arial, sans-serif;
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            margin-top: 200px;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 3rem;
            width: 500px;
        }

        .taskSection {
            border: 1px solid blue;
            border-radius: 10px;
            padding: 2rem 3rem;

            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .task {
            border: 3px solid #666;
            background-color: #ddd;
            border-radius: .5em;
            padding: 10px;
            cursor: move;
            width: 400px;
            word-break: break-all;

            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 0.2rem;
        }

        .task.over {
            border: 3px dotted #666;
        }

        [draggable] {
            user-select: none;
        }

        .createTaskForm {
            display: flex;
            width: 100%;
            gap: 1rem;
        }

        input {
            width: 100%;
            padding: 1rem 1.4rem;
            font-size: 1.4rem;
            border-radius: 10px;
        }

        button {
            cursor: pointer;
        }

        .btn {
            border-radius: 10px;
            font-size: 1.2rem;
            font-weight: bold;
        }

        button:hover {
            color: #4a554a;
            background: rgba(180, 180, 220, 0.6);
        }

        .flex1-5 {
            flex: 1;
        }

        .flex3-5 {
            flex: 3;
        }

        .color-red {
            color: #c4181e;
            font-weight: bold;
        }
	</style>
@endpush

@section("contentBody")

    <div class="container">

        <h1>Tasks</h1>
        <form action="{{ $saveUrl }}" method="POST" class="createTaskForm">
            @csrf

            @if($task)
                @method("PUT")
            @endif

            <input class="flex3-5" type="text" name="name" placeholder="Create New Task" value="{{ old("name", $task?->name) }}">
            <input class="flex1-5" type="text" name="priority" placeholder="Priority" value="{{ old("priority", $task?->priority) }}">

            <button class="flex1-5 btn">Submit</button>
        </form>
        <div class="taskSection">
            @foreach ($tasks as $task)
                <div class="task" draggable="true" data-task="{{ $task->toJson() }}">
                    <p>
                        {{ $task->id }}: {{ $task->name }},
                        <span class="color-red">Priority: {{ $task->priority }}</span>
                    </p>

                    <div>
                        <a href="{{ route("task.edit", $task->id) }}">&#9999;</a>
                        <button onclick="deleteTask(event)" data-taskid="{{ $task->id }}">&#10060;</button>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

@endsection

@push('scripts')
	<script>
        let dragSrcEl = null;

        function handleDragStart(e) {
            this.style.opacity = "0.4";

            dragSrcEl = this;

            e.dataTransfer.effectAllowed = "move";
        }

        function handleDragOver(e) {
            if (e.preventDefault) {
                e.preventDefault();
            }

            e.dataTransfer.dropEffect = "move";

            return false;
        }

        function handleDragEnter() {
            this.classList.add("over");
        }

        function handleDragLeave() {
            this.classList.remove("over");
        }

        function handleDrop(e) {
            const task = JSON.parse(e.target.dataset.task)
            const sourceTask = JSON.parse(dragSrcEl.dataset.task)

            if (e.stopPropagation) {
                e.stopPropagation();
            }

            if (dragSrcEl != this) {

                this.innerHTML = `${sourceTask.id}: ${sourceTask.name}`
                this.dataset.task = JSON.stringify(sourceTask)

                dragSrcEl.innerHTML = `${task.id}: ${task.name}`
                dragSrcEl.dataset.task = JSON.stringify(task)

                const taskPriority = task.priority
                task.priority = sourceTask.priority
                sourceTask.priority = taskPriority

                fetch(`http://127.0.0.1:8001/api/tasks/${task.id}/${sourceTask.id}`, {
                    method: "PATCH",
                    headers: {
                        'Accept': 'application/json',
                    },
                }).then((response) => response.json())
                    .then((data) => console.log(data));
            }

            return false;
        }

        function handleDragEnd() {
            this.style.opacity = "1";

            tasks.forEach(function (task) {
                task.classList.remove("over");
            });
        }

        let tasks = document.querySelectorAll(".task");
        tasks.forEach(function (task) {
            task.addEventListener("dragstart", handleDragStart, false);
            task.addEventListener("dragenter", handleDragEnter, false);
            task.addEventListener("dragover", handleDragOver, false);
            task.addEventListener("dragleave", handleDragLeave, false);
            task.addEventListener("drop", handleDrop, false);
            task.addEventListener("dragend", handleDragEnd, false);
        });

        function deleteTask(event) {
            event.preventDefault()
            const taskNode = event.target.parentNode.parentNode
            const taskId = event.target.dataset.taskid

            fetch(`http://127.0.0.1:8001/api/tasks/${taskId}`, {
                method: "DELETE",
                headers: {
                    'Accept': 'application/json',
                },
            }).then((response) => response.json())
                .then(data => {
                    taskNode.remove()
                    let notifier = new AWN()
                    notifier.success(data.message)
                });
        }

	</script>
@endpush
