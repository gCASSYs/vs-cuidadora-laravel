document.addEventListener('DOMContentLoaded', () => {
  // Elementos usados pelos controles globais do painel.
  const shell = document.querySelector('.vs-admin-shell');
  const sidebarButton = document.querySelector('[data-admin-toggle="sidebar"]');
  const fullscreenButton = document.querySelector('[data-admin-toggle="fullscreen"]');

  // Abre ou fecha o menu lateral e atualiza o estado para leitores de tela.
  sidebarButton?.addEventListener('click', () => {
    const collapsed = shell?.classList.toggle('is-sidebar-collapsed') ?? false;
    sidebarButton.setAttribute('aria-expanded', String(!collapsed));
  });

  // Alterna o navegador entre o modo normal e a tela cheia.
  fullscreenButton?.addEventListener('click', async () => {
    if (document.fullscreenElement) {
      await document.exitFullscreen();
    } else {
      await document.documentElement.requestFullscreen();
    }
  });

  // Mantém texto, ícones e atributos sincronizados com o estado da tela cheia.
  document.addEventListener('fullscreenchange', () => {
    const active = Boolean(document.fullscreenElement);
    fullscreenButton?.setAttribute('aria-pressed', String(active));
    fullscreenButton?.setAttribute('aria-label', active ? 'Sair da tela cheia' : 'Ativar tela cheia');
    document.querySelector('[data-fullscreen-icon="expand"]')?.classList.toggle('d-none', active);
    document.querySelector('[data-fullscreen-icon="collapse"]')?.classList.toggle('d-none', !active);
  });
});
