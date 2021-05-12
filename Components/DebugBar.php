<?php

declare(strict_types=1);

use App\Core\View;
?>

<div id="debug-bar" class="debug-bar">
    <div class="labels">
        <div data-category="messages">Messages</div>
        <div data-category="queries">Queries</div>
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
    }

    .debug-bar .labels div:hover {
        background: hsl(25, 100%, 50%);
    }

    .debug-bar .content {
        overflow-y: scroll;
        flex-grow: 1;
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

    for (const child of LABELS_ELEMENT.children) {
        const category = child.dataset.category;
        child.addEventListener("click", () => {
            for (const content of CONTENT_ELEMENT.children) {
                if (category === content.dataset.category) {
                    content.style.display = "block";
                } else {
                    content.style.display = "none";
                }
            }
        });
    }

    for (const content of CONTENT_ELEMENT.children) {
        content.style.display = "none";
    }
    CONTENT_ELEMENT.children[0].style.display = "block";
</script>