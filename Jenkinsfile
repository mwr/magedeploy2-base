node {
    // ENV variables
    env.PWD = pwd()

    // Tools Config
    def phpBin = "/usr/local/bin/php"
    def roboBin = "${phpBin} ./vendor/bin/robo"
    def deployerBin = "${phpBin} ./vendor/bin/dep"

    try {
        // Update Deployment
        stage('Tool Setup') {
            checkout scm
            sh "${phpBin} /usr/local/bin/composer.phar install"

            if (!fileExists('.env')) {
                sh "ln -s .env.jenkins .env"
            }

            // Print environment information
            sh "${phpBin} -v"
            sh "${roboBin} --version"
            sh "${deployerBin} --version"
            sh "printenv"
        }

        stage('Magento Setup') {
            if (MAGENTO_SETUP == 'true') {
                def options = ''
                if (DELETE_VENDOR == 'true'){
                    options += ' --drop-vendor'
                }
                if (DROP_DATABASE == 'true'){
                    options += ' --drop-database'
                }
                if (REINSTALL_PROJECT == 'true'){
                    options += ' --reinstall-project'
                }
                sh "${roboBin} -vvv deploy:magento-setup ${options} ${TAG}"
            }
        }

        stage('Artifact Generation') {
            if (GENERATE_ASSETS == 'true') {
                sh "${roboBin} deploy:artifacts-generate"

                archiveArtifacts 'artifacts/shop.tar.gz'
            }
        }

        stage('Deployment') {
            if (DEPLOY == 'true') {
                sh "${roboBin} -vvv deploy:deploy ${STAGE} ${TAG}"
            }
        }

    } catch (err) {
        echo "Exception thrown:\n ${err}"
        currentBuild.result = 'FAILURE'
        throw err
    }

    currentBuild.result == 'SUCCESS'
}
