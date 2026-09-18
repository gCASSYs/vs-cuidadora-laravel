---
version: alpha
name: "VS Cuidadora"
description: "Painel administrativo acolhedor e preciso, derivado da identidade visual do site VS Cuidadora."
colors:
  primary: "#62733D"
  primary-dark: "#34401B"
  primary-light: "#95B159"
  earth: "#8C493A"
  canvas: "#F5F7F0"
  surface: "#FFFFFF"
  surface-soft: "#E9EEDF"
  text: "#2E2E2E"
  muted: "#73655A"
  border: "#D4DDC4"
  focus: "#62733D"
typography:
  display:
    fontFamily: "Fresca, sans-serif"
  sans:
    fontFamily: "Rubik, system-ui, sans-serif"
  mono:
    fontFamily: "ui-monospace, SFMono-Regular, Menlo, monospace"
rounded:
  DEFAULT: "0.75rem"
  sm: "0.5rem"
  md: "0.75rem"
  lg: "1rem"
spacing:
  page-gutter: "clamp(1.25rem, 3vw, 2.75rem)"
  section-gap: "1.5rem"
components:
  sidebar:
    accent: "#95B159"
  card:
    border: "#D4DDC4"
  table:
    header: "#E9EEDF"
  button:
    primary: "#62733D"
---

# VS Cuidadora Design System

## Overview

### Creative North Star

O painel traduz a calma de uma casa bem cuidada: verde oliva profundo para orientação, superfícies claras para leitura e um toque terracota para sinalizar atenção humana. A expressão vem do site público, não de um tema administrativo genérico.

### Product context and register

- **Audience and primary job:** equipe que mantém conteúdos e informações da VS Cuidadora atualizados.
- **Target market(s) and evidence:** interface em português brasileiro, a partir dos conteúdos e rotas do projeto.
- **Locale(s) and language policy:** pt-BR; rótulos curtos, diretos e em linguagem de operação.
- **Usage scene:** uso recorrente em desktop para conferir listas e, ocasionalmente, em celular.
- **Register:** híbrido — o painel mantém a confiança da marca, mas prioriza leitura de dados e tarefas.
- **Memorable signature:** a lateral verde-escura recebe uma linha vertical de verde claro, como um traço de crescimento, enquanto títulos usam Fresca com moderação.
- **Restraint:** tabelas, filtros e estados continuam familiares em Bootstrap; não há textura, ilustração ou animação competindo com os registros.
- **Anti-references:** não usar café/espresso, preto pesado ou fonte condensada do tema anterior; não transformar listas em landing pages.
- **Token ownership/runtime mapping:** este arquivo documenta os tokens implementados em src/public/vs-cuidadora/css/admin.css, carregado por layout/dashboard.blade.php.

## Colors

primary-dark estrutura a navegação; primary identifica ações e foco; primary-light é exclusivamente um acento de orientação. canvas, surface e surface-soft organizam a leitura em camadas. earth é reservado a alertas de atenção e detalhes de marca.

## Typography

Fresca é usada apenas em marca e títulos de página. Rubik é a fonte de corpo, controles e tabelas, com pesos médios para informação densa. Não há caixa-alta forçada em textos corridos.

## Layout

A lateral tem 250px em desktop; o conteúdo usa margens fluidas e largura natural. Em telas estreitas, a lateral passa para o topo e os links quebram em grade. Tabelas permanecem em contêineres com rolagem horizontal.

## Elevation & Depth

Superfícies são separadas por borda verde-clara e sombra baixa, difusa. A lateral é a única massa escura. Não usar sombras pesadas em linhas de tabela.

## Shapes

Cartões e controles usam cantos arredondados de 8–16px. Badges mantêm formato de cápsula para comunicar estado; botões seguem raio médio, nunca totalmente pill.

## Components

### Foundational visual states

Foco visível usa anel verde. Hover de links e linhas de tabela usa verde suave; controles desabilitados permanecem visualmente quietos.

### Buttons and actions

Verde é a ação principal, contorno verde para ações secundárias e terracota apenas para cuidado/alerta.

### Navigation and data display

A página ativa aparece com superfície verde translúcida e barra lateral clara. O topo oferece apenas navegação útil — controle da lateral, acesso ao site e tela cheia — sem mensagens ou perfis fictícios. Cabeçalhos de tabela usam surface-soft; linhas alternam apenas por hover para preservar densidade. Ações por registro seguem o grupo compacto do AdminLTE, com lápis para edição e lixeira para exclusão; enquanto o CRUD não existe, permanecem visíveis e desabilitadas.

### Forms and overlays

Campos claros, com borda verde suave e foco verde. O navegador mantém controles nativos onde já são usados pelo projeto.

### Iconography

Bootstrap Icons quando disponível; ícones acompanham rótulos e não substituem ações textuais.

### Motion

Transições de cor e sombra duram 160ms. Com redução de movimento, transições e animações são praticamente removidas.

### Content and data visualization

Tom cordial e operacional em pt-BR. Totais e status usam contraste e texto, não somente cor.

## Do's and Don'ts

- **Do:** preservar verde oliva e Rubik como base compartilhada entre site e painel.
- **Do:** manter dados em tabelas claras, com foco em leitura e estado.
- **Don't:** reintroduzir cores, nomes ou tipografia do tema Barista.
- **Don't:** usar acentos decorativos que escondam ações, filtros ou registros.
