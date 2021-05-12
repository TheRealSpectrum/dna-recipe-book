<?php

declare(strict_types=1);

use App\Core\View;
?>

<div id="debug-bar" class="debug-bar">
    <div class="labels">
        <div class="toggle-bar">close</div>
        <div class="category" data-category="messages">Messages</div>
        <div class="category" data-category="queries">Queries</div>
    </div>
    <div class="content">
        <div class="messages" data-category="messages">
            <?php

            foreach ($messages as $message) {
                echo View::component("DebugMessage", $message);
            }

            ?>
        </div>
        <div class="queries" data-category="queries">
            <div>
                <div class="query">SELECT * FROM `users` WHERE `admin` IS 1</div>
                <div class="result">Result here lol</div>
            </div>
        </div>
    </div>
</div>

<style>
    .debug-bar {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100vw;
        height: 200px;
        background: hsl(42, 100%, 96%);
        border-top: 5px solid hsl(9, 98%, 43%);
        display: flex;
        flex-direction: column;
        transition-duration: 200ms;
    }

    .debug-bar .labels {
        display: flex;
        flex-direction: row;
        background: hsl(35, 100%, 73%);
    }

    .debug-bar .labels div {
        padding: 5px;
        font-size: 1.2rem;
        text-transform: uppercase;
        cursor: pointer;
        color: hsl(180, 30%, 22%);
        font-weight: bold;
        overflow-x: hidden;
        transition-duration: 200ms;
        width: 100px;
        text-align: center;
    }

    .debug-bar .labels div:hover {
        background: hsl(25, 100%, 50%);
    }

    .debug-bar .content {
        flex-grow: 1;
        display: flex;
        flex-direction: row;
        position: relative;
        left: 0;
        transition-duration: 200ms;
    }

    .debug-bar .content>div {
        overflow-y: scroll;
        width: 100vw;
        flex-shrink: 0;
    }

    .debug-bar .content .messages {
        display: flex;
        flex-direction: column;
    }

    .debug-bar .content .messages>div {
        display: grid;
        gap: 5px;
        grid-template-columns: 1fr 8fr 4fr;
        font-size: 1.1rem;
        padding: 5px;
    }

    .debug-bar .content .messages>div:nth-child(even) {
        background-color: hsl(12, 80%, 66%);
    }

    .debug-bar .content .messages .level {
        text-transform: uppercase;
        font-weight: bold;
    }

    .debug-bar .content .messages .file {
        color: hsl(220, 4%, 27%);
        text-decoration: underline;
    }
</style>

<script>
    const DEBUG_BAR_ELEMENT = document.getElementById('debug-bar');
    const LABELS_ELEMENT = Array.from(DEBUG_BAR_ELEMENT.children).find((child) => child.classList.contains("labels"));
    const CONTENT_ELEMENT = Array.from(DEBUG_BAR_ELEMENT.children).find((child) => child.classList.contains("content"));

    let i = 0;
    for (const child of LABELS_ELEMENT.children) {
        if (child.classList.contains("toggle-bar")) {
            let isOpen = true;
            child.addEventListener("click", () => {
                DEBUG_BAR_ELEMENT.style.height = isOpen ? "32px" : "200px";
                child.textContent = isOpen ? "open" : "close";
                for (const labelChild of LABELS_ELEMENT.children) {
                    if (child === labelChild) {
                        continue;
                    }
                    labelChild.style.padding = isOpen ? "0" : "5px";
                    labelChild.style.width = isOpen ? "0" : "100px";
                }
                isOpen = !isOpen;
            });
            continue;
        }

        const category = child.dataset.category;
        const offset = `-${i*100}vw`;
        child.addEventListener("click", () => {
            CONTENT_ELEMENT.style.left = offset;
        });
        ++i;
    }
</script>