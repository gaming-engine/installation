module.exports = {
  verbose: true,
  roots: ['<rootDir>/resources/js'],
  modulePaths: ['resources/js'],
  moduleDirectories: ['node_modules'],
  moduleFileExtensions: ['js', 'vue'],
  moduleNameMapper: {
    '^@mixins/(.*)$': '<rootDir>resources//js//mixins//$1',
    '^@components/(.*)$': '<rootDir>resources//js//components//$1',
  },
  transform: {
    '^.+\\.js$': 'babel-jest',
    '^.+\\.vue$': 'vue3-jest',
  },
  snapshotSerializers: [
    '<rootDir>/node_modules/jest-serializer-vue',
  ],
  testEnvironment: 'jsdom',
  coverageThreshold: {
    global: {
      branches: 85,
      functions: 85,
      lines: 85,
      statements: 85,
    },
  },
  coverageDirectory: './build/vue/',
  coverageReporters: ['json', 'html'],
};
