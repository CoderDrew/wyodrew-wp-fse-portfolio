document.addEventListener("DOMContentLoaded", () => {
  if (!document.body.classList.contains("home")) return;

  const sequence = [
    { id: "hero-brace-left", text: "{ ", x: 0 },
    { id: "hero-wyo", text: "WYO", x: 34 },
    { id: "hero-brace-right", text: " } ", x: 132 },
    { id: "hero-drew", text: "DREW", x: 158 },
  ];

  const cursor = document.getElementById("hero-cursor");
  const cursorOffsets = {
    "hero-brace-left": 26,
    "hero-wyo": 88,
    "hero-brace-right": 24,
    "hero-drew": 132,
  };

  let step = 0;
  let char = 0;
  let currentText = "";

  function updateCursorPosition(elementId, textLength) {
    const baseX = sequence[step].x;
    const charWidth = cursorOffsets[elementId] / sequence[step].text.length;
    cursor.setAttribute("x", baseX + (charWidth * textLength));
    cursor.setAttribute("y", 49);
  }

  function type() {
    if (step >= sequence.length) {
      cursor.classList.add("blink");
      cursor.style.opacity = 1;
      return;
    }

    const { id, text } = sequence[step];
    const el = document.getElementById(id);

    if (!el) return;

    currentText += text.charAt(char);
    el.textContent = currentText;
    char++;

    updateCursorPosition(id, currentText.length);

    if (char >= text.length) {
      step++;
      char = 0;
      currentText = "";
      setTimeout(type, 140); // pause between chunks
    } else {
      setTimeout(type, 60); // typing speed
    }
  }

  cursor.style.opacity = 1;
  type();
});
