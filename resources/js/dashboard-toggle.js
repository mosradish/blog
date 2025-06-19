document.addEventListener('DOMContentLoaded', () => {
    const toggleInput = document.getElementById('toggle-all-actions');
    const toggleDot = document.getElementById('toggle-dot');
    const toggleBg = document.getElementById('toggle-bg');
    const toggleLabelText = document.getElementById('toggle-label-text');
    const checkboxes = document.querySelectorAll('.action-checkbox');

    // チェックボックスの初期状態が全てONかどうか判定
    function allChecked() {
        return Array.from(checkboxes).every(cb => cb.checked);
    }

    // トグルの表示更新
    function updateToggleUI(isChecked) {
        if (isChecked) {
            toggleDot.style.transform = 'translateX(100%)';
            toggleBg.classList.remove('bg-gray-400');
            toggleBg.classList.add('bg-indigo-600');
            toggleLabelText.textContent = 'すべてON';
        } else {
            toggleDot.style.transform = 'translateX(0)';
            toggleBg.classList.remove('bg-indigo-600');
            toggleBg.classList.add('bg-gray-400');
            toggleLabelText.textContent = 'すべてOFF';
        }
    }

    // 初期表示調整（ページロード時）
    updateToggleUI(toggleInput.checked);

    // トグルクリックで全チェックON/OFF
    toggleInput.addEventListener('change', () => {
        const isChecked = toggleInput.checked;
        checkboxes.forEach(cb => cb.checked = isChecked);
        updateToggleUI(isChecked);
    });

    // 個別チェック変更でトグル・ラベル連動
    checkboxes.forEach(cb => {
        cb.addEventListener('change', () => {
            const isAll = allChecked();
            toggleInput.checked = isAll;
            updateToggleUI(isAll);
        });
    });
});
