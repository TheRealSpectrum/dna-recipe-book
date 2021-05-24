<?php

/**
 * This file has been created using the power of determination and a lot of coffee.
 * 
 * It is an absolute miracle that it even works, please to not edit it too much, preferably not at all.
 * Also don't copy anything starting from the style tag since it's absolute shit thank you very much.
 */

declare(strict_types=1);

use App\Core\View;
?>

<div id="debug-bar" class="debug-bar">
    <div class="labels">
        <div class="expand">+</div>
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
            <?php

            foreach ($queries as $query) {
                echo View::component("QueryMessage", $query);
            }

            ?>
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
        height: 35px;
    }

    .debug-bar .labels div {
        padding: 5px;
        font-size: 1.05rem;
        text-transform: uppercase;
        cursor: pointer;
        color: hsl(180, 30%, 22%);
        font-weight: bold;
        overflow-x: hidden;
        overflow-y: visible;
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
        position: relative;
        height: 170px;
    }

    .debug-bar .content>div {
        overflow-y: scroll;
        width: 100vw;
        flex-shrink: 0;
        height: 170px;
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

    .debug-bar .content .queries {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .debug-bar .content .queries>div {
        padding: 5px;
        display: flex;
        flex-direction: column;
        gap: 5px;
        height: auto;
    }

    .debug-bar .content .queries>div:nth-child(even) {
        background-color: hsl(12, 80%, 66%);
    }

    .debug-bar .content .queries .query-data {
        display: flex;
        flex-direction: row;
        gap: 0px;
        padding: 0;
        transform: scaleY(0);
        height: 0;
        transition-duration: 200ms;
    }

    .debug-bar .content .queries .expanded .query-data {
        height: auto;
        transform: none;
    }

    .debug-bar .content .queries .query-data .expand {
        display: inline-block;
        width: 14px;
        cursor: pointer;
        transition-duration: 200ms;
    }

    .debug-bar .content .queries .query-data.expanded {
        flex-direction: column;
        padding: 5px;
        border-bottom: 1px solid hsl(0, 0%, 0%);
        transition-duration: 200ms;
    }

    .debug-bar .content .queries .query-data.expanded .expand {
        transform: scale(-1, 1);
    }

    .debug-bar .content .queries .query-data>div+div {
        height: 20px;
        display: flex;
        flex-direction: row;
        gap: 2px;
        margin-left: 15px;
    }

    .debug-bar .content .queries .query-data.expanded>div+div {
        display: grid;
        grid-template-rows: 1fr;
        grid-template-columns: 5fr 4fr;
        width: 200px;
    }

    .debug-bar .content .queries .sql-query {
        display: flex;
        flex-direction: row;
        gap: 5px;
    }

    .debug-bar .content .queries .sql-query .expand {
        padding: 0 5px;
        font-weight: bold;
        background-color: hsla(0, 0%, 80%, 0.5);
        border-radius: 5px;
        cursor: pointer;
    }

    .debug-bar .content .queries code {
        background-color: hsl(0, 0%, 100%);
        color: hsl(0, 0%, 0%);
        border: 1px solid hsl(0, 0%, 0%);
        padding: 3px;
    }

    .debug-bar .content .queries .query-data .key::before {
        content: "|";
        margin-right: 10px;
    }

    .debug-bar .content .queries .query-data .key::after {
        content: ":";
        margin-right: 2px;
    }
</style>

<script>
    const DEBUG_BAR_ELEMENT = document.getElementById('debug-bar');
    const LABELS_ELEMENT = Array.from(DEBUG_BAR_ELEMENT.children).find((child) => child.classList.contains("labels"));
    const CONTENT_ELEMENT = Array.from(DEBUG_BAR_ELEMENT.children).find((child) => child.classList.contains("content"));
    const QUERIES_ELEMENT = Array.from(CONTENT_ELEMENT.children).find((child) => child.classList.contains("queries"));

    let i = 0;
    let isExpanded = false;
    let expander = null;
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

                if (isOpen) {
                    isExpanded = false;
                    expander.textContent = "+";

                    CONTENT_ELEMENT.style.height = "170px";
                    for (const contentChild of CONTENT_ELEMENT.children) {
                        contentChild.style.height = "170px";
                    }
                }

                isOpen = !isOpen;
            });
            continue;
        }
        if (child.classList.contains("expand")) {
            expander = child;
            child.addEventListener("click", () => {
                DEBUG_BAR_ELEMENT.style.height = isExpanded ? "200px" : "500px";
                child.textContent = isExpanded ? "+" : "-";

                CONTENT_ELEMENT.style.height = isExpanded ? "170px" : "470px";
                for (const contentChild of CONTENT_ELEMENT.children) {
                    contentChild.style.height = isExpanded ? "170px" : "470px";
                }

                isExpanded = !isExpanded;
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

    for (const query of QUERIES_ELEMENT.children) {

        const expandToggle = query.children[0].children[2];
        expandToggle.addEventListener("click", () => {
            expandToggle.textContent = query.classList.toggle("expanded") ? "-" : "+";
        })

        for (const queryData of query.children[1].children) {
            const expandButton = queryData.children[0];
            expandButton.addEventListener("click", () => {
                queryData.classList.toggle("expanded");
            });
        }
    }
</script>