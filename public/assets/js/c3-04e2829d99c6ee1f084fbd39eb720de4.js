require("../styles/c3.css")

window.showDialog = showDialog;
export function showDialog(msg, title = "", okEvent = null) {
    const body = document.body;

    const panel = document.createElement("dialog");
    panel.classList = "msgBox";
    panel.addEventListener('click', function (event) {
        if (!event.target.closest('.msgBox .inner')) {
            panel.close();
        }
    });
    body.appendChild(panel);

    const inner = document.createElement("div");
    inner.classList = "inner";

    if (title ?? "" !== "") {
        const header = document.createElement("div");
        header.classList = "header";
        header.textContent = title;
        inner.appendChild(header);
    }

    const content = document.createElement("div");
    content.classList = "body";
    content.innerHTML = "<p>" + msg + "</p>";
    inner.appendChild(content);

    const footer = document.createElement("div");
    footer.classList = "footer";

    let btn = document.createElement("button");
    btn.classList = "button ok";
    btn.textContent = "OK";
    btn.addEventListener("click", () => {
            panel.parentNode.removeChild(panel)
        }
    );
    btn.addEventListener("click", okEvent);
    footer.appendChild(btn);

    btn = document.createElement("button");
    btn.classList = "button cancel";
    btn.textContent = "キャンセル";
    btn.addEventListener("click", () =>
        panel.parentNode.removeChild(panel),
    );
    footer.appendChild(btn);

    inner.appendChild(footer);
    panel.appendChild(inner);

    panel.showModal();
}