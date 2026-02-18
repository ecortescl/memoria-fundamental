<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Git Avanzado</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #1f2937; line-height: 1.6; padding: 40px 20px; }
        .container { max-width: 900px; margin: 0 auto; }
        h1 { font-size: 32px; font-weight: 600; color: #FF2D20; margin-bottom: 24px; }
        h2 { font-size: 24px; font-weight: 600; margin: 32px 0 16px; }
        .card { background: #fff; padding: 24px; border-radius: 4px; border: 1px solid #e5e7eb; margin-bottom: 24px; }
        pre { background: #1f2937; color: #f9fafb; padding: 16px; border-radius: 4px; overflow-x: auto; margin: 16px 0; }
        .back { display: inline-block; color: #FF2D20; text-decoration: none; margin-bottom: 24px; }
    </style>
</head>
<body>
    <div class="container">
        <a href="/ejemplos/devops" class="back">← Volver</a>
        
        <h1>🌿 Git Avanzado</h1>

        <div class="card">
            <h2>🔄 Git Flow</h2>
            <pre><code># Branches principales
main (producción)
develop (desarrollo)

# Feature branches
git checkout -b feature/nueva-funcionalidad develop
git checkout develop
git merge --no-ff feature/nueva-funcionalidad

# Release branches
git checkout -b release/1.0.0 develop
git checkout main
git merge --no-ff release/1.0.0
git tag -a v1.0.0

# Hotfix
git checkout -b hotfix/bug-critico main
git checkout main
git merge --no-ff hotfix/bug-critico</code></pre>
        </div>

        <div class="card">
            <h2>🔧 Rebase interactivo</h2>
            <pre><code># Limpiar commits antes de merge
git rebase -i HEAD~3

# Opciones:
# pick = usar commit
# reword = cambiar mensaje
# squash = combinar con anterior
# fixup = combinar sin mensaje
# drop = eliminar commit

# Ejemplo:
pick abc123 feat: agregar login
squash def456 fix: typo
reword ghi789 feat: agregar registro</code></pre>
        </div>

        <div class="card">
            <h2>🍒 Cherry-pick</h2>
            <pre><code># Aplicar commit específico de otra branch
git cherry-pick abc123

# Múltiples commits
git cherry-pick abc123 def456

# Sin commit automático
git cherry-pick -n abc123</code></pre>
        </div>

        <div class="card">
            <h2>🔧 Stash</h2>
            <pre><code># Guardar cambios temporalmente
git stash

# Con mensaje
git stash save "WIP: nueva feature"

# Listar
git stash list

# Aplicar último
git stash pop

# Aplicar específico
git stash apply stash@{0}</code></pre>
        </div>

        <div class="card">
            <h2>🪝 Git Hooks</h2>
            <pre><code># .git/hooks/pre-commit
#!/bin/sh
php artisan test
if [ $? -ne 0 ]; then
    echo "Tests fallaron, commit cancelado"
    exit 1
fi

# Hacer ejecutable
chmod +x .git/hooks/pre-commit</code></pre>
        </div>
    </div>
</body>
</html>
